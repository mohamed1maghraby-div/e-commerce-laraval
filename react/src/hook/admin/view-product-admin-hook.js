import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getAllProducts, getAllProductsPage } from "../../redux/actions/ProductsAction";


const ViewProductAdminHook = () => {
    
    const dispatch = useDispatch();

    useEffect(()=>{
        dispatch(getAllProducts(10))
    }, [])

    const onPress = async (page) =>{
        await dispatch(getAllProductsPage(page))
    }

    const allProducts = useSelector((state) => state.allproducts.allProducts)
    let items= [];
    try{
        if(allProducts)
            items=allProducts;
        else
            items=[]
    
        if(items)
            var pageCount = items.last_page
        else
            pageCount = 0;
    }catch(e){
        console.log(e)
    }

    return [items,onPress,pageCount]
}

export default ViewProductAdminHook