import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getProduct } from "../../redux/actions/ProductsAction"
import mobile from '../../Assets/images/mobile.png'

const ViewProductDetailsHook = (id) => {

    const dispatch = useDispatch();

    useEffect(()=>{
        dispatch(getProduct(id))
    }, [])

    const oneProduct = useSelector((state) => state.allproducts.oneProduct)
    
    let item= [];

    if(oneProduct)
        item=oneProduct;
    else
        item=[]

    //to view images gellery
    let images = [];
    if(item.media){
        images = item.media.map((img) => {
            return{original:img.file_name}
        })
    }else{
        images = [{ original: `${mobile}` }]
    }


    return [item,images]
}

export default ViewProductDetailsHook