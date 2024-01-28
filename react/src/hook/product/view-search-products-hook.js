import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getAllProducts, getAllProductsPage, getAllProductsSearch } from "../../redux/actions/ProductsAction";


const ViewSearchProductsHook = () => {
    let limit = 6;
    const dispatch = useDispatch();

    const getProducts = async () =>{
        await dispatch(getAllProductsSearch(`limit=${limit}`))
    }
    useEffect(()=>{
        getProducts()
    }, [])

    const allProducts = useSelector((state) => state.allproducts.allProducts)
    
    let items= [];
    try{
        if(allProducts.data)
            items=allProducts.data;
        else
            items=[]
    }catch(e){
        console.log(e)
    }

    try{
        if(items){
            var pageCount = allProducts.last_page
        }
        else{
            pageCount = 0;
        }
    }catch(e){
        console.log(e)
    }

    const onPress = async (page) =>{
        await dispatch(getAllProductsPage(page))
    }

    return [items, onPress, pageCount]
}

export default ViewSearchProductsHook