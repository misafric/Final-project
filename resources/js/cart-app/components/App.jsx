import React, {useState,useEffect} from 'react';

function App() {
    const csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const today = new Date();
    const tomorrow = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate()+1);

    const [{dataSet,loaded},setDataSet] = useState(
        {
            dataSet:[],
            loaded:false
        }
    );

    const [totalAmount,setTotalAmount] = useState(0);

    const [deliveryDate,setDeliveryDate] = useState(0);

    // const [articleDDs, setArticleDDs] = useState([]);

    const fetchData = async () => {
        const response = await fetch(
            `/api/cart/index`
        );
        const data = await response.json();
        response && data && data.cart_items && setDataSet({
            dataSet:data.cart_items,
            loaded:true
        })
        console.log(tomorrow)
    }

    const recalculateDeliveryDate = () => {
        let newArticleDDs = [0,1];
        dataSet.forEach((order_item) => {
            newArticleDDs.push( (order_item.order_qty > order_item.stock_qty) ? order_item.next_restock : tomorrow);
        });
        console.log(newArticleDDs[0]);
        const earliestAvailable = newArticleDDs.reduce(function (a, b) { return a < b ? a : b; });
        const latestAvailable = newArticleDDs.reduce(function (a, b) { return a > b ? a : b; });
        console.log(earliestAvailable)
        console.log(latestAvailable)
        setDeliveryDate(latestAvailable)
    }

    const recalculateTotalAmount = () => {
        let newTotalAmount = 0;
        dataSet.forEach((order_item) => {
            newTotalAmount += order_item.order_qty * order_item.order_unit_price;
        });
        setTotalAmount(newTotalAmount)
    }

    const handleQtyChange = (event) => {
        const newValue = (event.target.value < 1) ? 1 : event.target.value;
        let newDataSet = dataSet;
        newDataSet[event.target.id].order_qty = newValue;
        setDataSet({dataSet:newDataSet,loaded:true});    
        console.log('dataSet changed');
        console.log(dataSet);
        recalculateTotalAmount();
        recalculateDeliveryDate();
    }

    useEffect(() => {
        recalculateDeliveryDate();
    },[loaded])

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
                        {/* Article ID (just for check, actually in hidden input): {item.article_id} <br/> */}
                        <input type="hidden" name="article_id[]" id="input_article_id" value={item.article_id} form="order_form"/>
                        Unit Price: {item.order_unit_price}CZK <br/>
                        <input type="hidden" name="order_unit_price[]" value={item.order_unit_price} form="order_form"/>
                        Order Qty: <input type="number" id={i} value={item.order_qty} min="1" onChange={handleQtyChange} name="order_qty[]" form="order_form"/> <br/>
                        {(item.order_qty*1 > item.stock_qty*1) ? (<>Will cause delay until {item.next_restock}</>) : (<></>)}
                        <form action="/api/cart/remove" method="post">
                            <input type="hidden" name="_token" value={csrf_token} />
                            <input type="hidden" name="cart_item_id" value={i} />
                            <input type="submit" value="Remove from Cart" />
                        </form>
                        <br/>
                    </div>
                )})}
            {(dataSet.length===0) ? (<><h3>Your cart is currently empty.</h3></>) :
            (
            <>  
                <h3>Total Amount: {totalAmount}CZK</h3>
                <h4>Delivery Date: {deliveryDate}</h4>
                <br/>
                
                {/* {articleDDs.map((dd) => {
                    <><h6>{dd}</h6><br/></>
                })
                } */}

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

