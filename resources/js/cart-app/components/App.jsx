import React, {useState,useEffect} from 'react';

function App() {
    const csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const [{dataSet,loaded},setDataSet] = useState(
        {
            dataSet:[],
            loaded:false
        }
    );

    const [totalAmount,setTotalAmount] = useState(0);

    const fetchData = async () => {
        const response = await fetch(
            `/api/cart/index`
        );
        const data = await response.json();
        response && data && data.cart_items && setDataSet({
            dataSet:data.cart_items,
            loaded:true
        })
    }

    const recalculateTotalAmount = () => {
        let newTotalAmount = 0;
        dataSet.forEach((order_item) => {
            newTotalAmount += order_item.order_qty * order_item.order_unit_price;
        });
        setTotalAmount(newTotalAmount)
    }

    const handleQtyChange = (event) => {
        const newValue = (event.target.value < 1) ? 1 : event.target.value 
        let newDataSet = dataSet;
        newDataSet[event.target.id].order_qty = newValue;
        setDataSet({dataSet:newDataSet,loaded:true})     
        console.log('dataSet changed')
        console.log(dataSet)
        recalculateTotalAmount()
    }

    useEffect(() => {
        fetchData()
    },[])

    useEffect(() => {
        recalculateTotalAmount();
    },[loaded])

    return <>
        {(!loaded) ? (<>Loading</>) :(
            <div className='cart-items'>
                {dataSet.map((item,i) => { return(
                    <div className="cart-item" key={i}>
                        <img className='cart-item__image' src={'/img/goods/'+item.image_url} alt=""/><br/>
                        Product Name: {item.product_name + ' ' +item.identifiers}<br/>
                        Article ID (just for check, actually in hidden input): {item.article_id} <br/>
                        <input type="hidden" name="article_id" id="input_article_id" value={item.article_id}/>
                        Unit Price: {item.order_unit_price}CZK <br/>
                        Order Qty: <input type="number" id={i} value={item.order_qty} min="1" onChange={handleQtyChange}/> <br/>
                        <form action="/api/cart/remove" method="post">
                            <input type="hidden" name="_token" value={csrf_token} />
                            <input type="hidden" name="cart_item_id" value={i} />
                            <input type="submit" value="Remove from Cart" />
                        </form>
                        <br/>
                    </div>
                )})}
            {(dataSet.length===0) ? (<>Your cart is empty. Go buy something... chop, chop!</>) :
            (
            <>  
                <h3>Total Amount: {totalAmount}CZK</h3>
                <form action="/api/cart/empty" method="post">
                    <input type="hidden" name="_token" value={csrf_token} />
                    <input type="submit" value="Empty Cart"></input>
                </form>
            </>)
            }
            </div>
        )}
    </>
}

export default App;

