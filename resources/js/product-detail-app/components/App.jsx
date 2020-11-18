import React, {useState,useEffect} from 'react';

function App() {
    const product_id = document.querySelector('meta[name="product_id"]').getAttribute('content');
    // const initial_selection = document.querySelector('meta[name="initial_selection"]').getAttribute('content');

    const [{dataSet,loaded},setDataSet] = useState(
        {
            dataSet:{},
            loaded:false
        }
    );

    const [availableFilters,setAvailableFilters] = useState(null);

    const [currentSelection,setCurrentSelection] = useState('');

    const [currentSelectionId,setCurrentSelectionId] = useState(
        window.location.href.substring(window.location.href.lastIndexOf('/')+1,window.location.href.length)
    );
    
    const [reloadReady, setReloadReady] = useState(false)

    const [orderQty, setOrderQty] = useState(0);

    const createCurrentSelection = (data) => {
        let result = {values:[]};
        data.forEach((c) => {
            c.tags.forEach((t) => {
                    if (t.preselected) {
                            result = {...result,[c.name] : t.id}
                            result.values.push(t.id)
                        }
                }
            )
            
        });

        // data.forEach((c) => {
        //     result = {...result,[c.name]:c.tags[0].id}
        //     result.values.push(c.tags[0].id)
        // });

        return result;
    }

    const fetchData = async() => {
        const response = await fetch(
            `/api/product/${product_id}/articles/${currentSelectionId}`
        );
        const data = await response.json();

        console.log(data);
                
        setAvailableFilters(
            data.identifier_tags.map((c,i) => {
                    return ({
                        name:c.name,
                        order: i,
                        values:c.tags.map((t) => { return{name:t.name, value:t.id}})
                    })
                }
            )
        )

        {setCurrentSelection(
            createCurrentSelection(data.identifier_tags)
        )}

        setDataSet({dataSet:data,loaded:true});
    };

    const handleFilterChange = (event) => {
        setCurrentSelection((currentSelection) => {
            let valueArray = currentSelection.values;
            valueArray[event.target.id] = event.target.value*1
            return {...currentSelection,[event.target.name]:event.target.value*1,values: valueArray}
        });
        console.log(currentSelection.values[1]);
        setReloadReady(() => {
            return true;
        })
    }

    useEffect(() => {
        fetchData();
    }, [])

    useEffect(() => {
        if (loaded)
        {setCurrentSelectionId(() => {
            return (
                currentSelection.values && currentSelection.values.join('-')
            )
            })
        }
    },[currentSelection,dataSet])

    const shareURL = () => {
        const productUrl = window.location.href.substring(0,window.location.href.lastIndexOf('/')+1) 
        alert('Your friends can find this product at: \n' + productUrl + currentSelectionId)
    }

    const handleQtyChange = (e) => {
        setOrderQty(() => {
                console.log(e.target.value);
                return e.target.value;
            }
        )
        
    }

   useEffect(() => {
        if(reloadReady) {
            history.pushState({},'',currentSelectionId)
        }
    },[currentSelectionId,reloadReady])

    return (
        <>
            {
                loaded ? (
                    <div>
                        <img src={'/img/' + dataSet.articles[currentSelectionId].images[0].url}
                            alt={dataSet.articles[currentSelectionId].images[0].url}/> <br/>

                        TAGS: <br/> {dataSet.articles[currentSelectionId].tags.map ((t,i) => {
                            
                            return (t.is_identifier == 0) ? (<><span key={i}>{t.name}</span><br/></>) : (<></>)
                        })}

                        {availableFilters.map((c,i) =>
                            {
                            return <>
                                    {c.name}: <select onChange={handleFilterChange} name={c.name} id={c.order} key={'select'+c.order}
                                        value={currentSelection.values[i]} >
                                        {c.values.map((v,i) => <option key={'option'+i} value={v.value}
                                            >{v.name}</option>)
                                        }

                                    </select>
                                    </>
                            }
                        )}

                        <button onClick={shareURL}>Share</button><br/>
                        
                        <div className="order-form">
                            <input type="hidden" name="product_id" value={product_id} form="order_form"/>
                            <input type="hidden" name="article_id" value={dataSet.articles[currentSelectionId].id} form="order_form"/>
                            <input type="number" onChange={handleQtyChange} name="order_qty" value={orderQty} min="0" form="order_form"/>
                            <input type="submit" value="Order" form="order_form"/>
                        </div>
                        
                    </div>
                ) : (
                    <div>Loading</div>
                )
            }

        </>
    )
}

export default App;