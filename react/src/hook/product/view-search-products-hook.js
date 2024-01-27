import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getAllProducts, getAllProductsPage } from "../../redux/actions/ProductsAction";


const ViewSearchProductsHook = () => {
    
    const dispatch = useDispatch();

    useEffect(()=>{
        dispatch(getAllProducts(10))
    }, [])

    const allProducts = useSelector((state) => state.allproducts.allProducts)
    
    let items= [];
    if(allProducts.data)
        items=allProducts.data;
    else
        items=[]

    const onPress = async (page) =>{
        await dispatch(getAllProductsPage(page))
    }

    if(items){
        var pageCount = allProducts.last_page
    }
    else{
        pageCount = 0;
    }

    return [items, onPress, pageCount]
}

export default ViewSearchProductsHook