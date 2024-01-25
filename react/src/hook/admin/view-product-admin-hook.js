import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getAllProducts } from "../../redux/actions/ProductsAction";


const ViewProductAdminHook = () => {
    
    const dispatch = useDispatch();

    useEffect(()=>{
        dispatch(getAllProducts(10))
    }, [])

    const allProducts = useSelector((state) => state.allproducts.allProducts)
    
    if(allProducts.data){
        console.log(allProducts)
    }

    let items= [];
    if(allProducts)
        items=allProducts;
    else
        items=[]

    return [items]
}

export default ViewProductAdminHook