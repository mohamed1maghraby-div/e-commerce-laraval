import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getAllProducts } from "../../redux/actions/ProductsAction";


const ViewSearchProductsHook = () => {
    
    const dispatch = useDispatch();

    useEffect(()=>{
        dispatch(getAllProducts())
    }, [])

    const allProducts = useSelector((state) => state.allproducts.allProducts)
    
    if(allProducts.data){
        console.log(allProducts.data)
    }

    let items= [];
    if(allProducts.data)
        items=allProducts.data;
    else
        items=[]

    return [items]
}

export default ViewSearchProductsHook