import React, {useState,useEffect} from 'react';

function App() {
    const product_id = document.querySelector('meta[name="product_id"]').getAttribute('content');

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

    const [orderQty, setOrderQty] = useState(1);

    const [currentImg, setCurrentImg] = useState(0);

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

    const clearSuccessMsg = () => {
        document.getElementById('success-message').style.visibility='hidden'
    }

    const handleFilterChange = (event) => {
        setCurrentSelection((currentSelection) => {
            let valueArray = currentSelection.values;
            valueArray[event.target.id] = event.target.value*1
            return {...currentSelection,[event.target.name]:event.target.value*1,values: valueArray}
        });
        console.log(currentSelection.values[1]);
        document.getElementById('success-message') && clearSuccessMsg();
        handleImgChange(); 
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
                (currentSelectionId == 0) ? (0) : 
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
        const newValue = (e.target.value < 1) ? 1 : e.target.value
        setOrderQty(() => {
                return newValue;
            }
        )
        
    }

    const handleImgChange = () => {
        const newImg = (currentImg < dataSet.articles[currentSelectionId].imgs_count-1) ? currentImg + 1 : 0
        console.log(newImg);
        setCurrentImg(() => {
                return newImg;
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
                    <div className="wrap-all">
<div className="wrap-image">
                        {dataSet.articles[currentSelectionId].images[0] ? (
                        <>
                            <img className="img_product_detail" src={'/img/goods/' + dataSet.articles[currentSelectionId].images[currentImg].url}
                                alt={dataSet.articles[currentSelectionId].images[0].url}
                                onClick={handleImgChange}
                                style={{cursor: 'pointer'}}/> <br/>
                        </>) : (
                        <h3>NO IMAGE IN DATABASE, WE'RE SORRY</h3>
                        
                        )                        
                        }
</div>                        
<div className="filter-form">
                        <br/> {dataSet.articles[currentSelectionId].tags.map ((t,i) => {
                            
                            return (t.tag_category.is_visible == 1) ? (
                            <><span key={i}>{t.name}</span><br/></>
                            ) : (<></>)
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

                        {/* <button onClick={shareURL}>Share</button><br/> */}
                        
                        <div className="order-form">
                            <input type="hidden" name="product_id" value={product_id} form="order_form"/>
                            <input type="hidden" name="article_id" value={dataSet.articles[currentSelectionId].id} form="order_form"/>
                            <input className="input-order-quantity" type="number" onChange={handleQtyChange} name="order_qty" value={orderQty} min="1" form="order_form"/>
                            <input type="hidden" name="next_restock" value={dataSet.articles[currentSelectionId].next_restock} form="order_form"/>
                            <input type="hidden" name="stock_qty" value={dataSet.articles[currentSelectionId].stock_qty} form="order_form"/><br/><br/>
                            <input className="add" type="submit" value="Add to cart" form="order_form"/>
                            <div className="sentence">
                            {(orderQty > dataSet.articles[currentSelectionId].stock_qty) ?
                                (<>
                                    <br/> We're sorry, we don't have this many items on stock. Your delivery will take until {dataSet.articles[currentSelectionId].next_restock} to complete
                                    
                                </>) : (
                                <></>
                                )}
                                </div>
                                
                        </div>
                        
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