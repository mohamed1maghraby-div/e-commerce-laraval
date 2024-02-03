import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux"
import { getAllProducts, getAllProductsPage, getAllProductsSearch } from "../../redux/actions/ProductsAction";


const ViewSearchProductsHook = () => {
    let limit = 6;
    const dispatch = useDispatch();

    const getProducts = async () =>{
        let word='';
        if(localStorage.getItem("searchWord") != null)
            word= localStorage.getItem("searchWord")
            sortData()
        await dispatch(getAllProductsSearch(`sort_by=${sort}&order_by=${sortBy}&limit=${limit}&keyword=${word}`))
    }
    useEffect(()=>{
        getProducts()
    }, [])

    const allProducts = useSelector((state) => state.allproducts.allProducts)
    
    let items= [];
    try{
        if(allProducts.data)
            items=allProducts.data
        else
            items=[]
    }catch(e){
        console.log(e)
    }

    try{
        if(items){
            var pageCount = allProducts.last_page
            var totalItems = allProducts.total
        }
        else{
            pageCount = 0;
            totalItems = 0;
        }
    }catch(e){
        console.log(e)
    }

    //when click pagination
    const onPress = async (page) =>{
        let word='';
        if(localStorage.getItem("searchWord") != null)
            word= localStorage.getItem("searchWord")
            sortData()
        await dispatch(getAllProductsSearch(`sort_by=${sort}&order_by=${sortBy}&limit=${limit}&page=${page}&keyword=${word}`))
    }

    let sortType="", sort="", sortBy="";
    //when user choose sort type 
    const sortData = () => {
        if(localStorage.getItem("sortType") != null){
            sortType = localStorage.getItem("sortType")
        }else{
            sortType = "";
        }

        if(sortType === "السعر من الاقل للأعلى"){
            sort = "price";
            sortBy = "ASC";
        }else if(sortType === "السعر من الاعلى للأقل"){
            sort = "price";
            sortBy = "DESC";
        
        }else if(sortType === "الاعلى تقييما"){ //unprepared in backend
            sort = "quantity";
            sortBy = "DESC";
        
        }else if(sortType === "الاكثر مبيعا"){ //unprepared in backend
            sort = "price";
            sortBy = "DESC";
        }
    }

    return [items, onPress, pageCount, totalItems, getProducts]
}

export default ViewSearchProductsHook