import { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { getAllCategory } from "../../redux/actions/CategoryAction";
import { getAllBrand } from "../../redux/actions/BrandAction";
import ViewSearchProductsHook from "../product/view-search-products-hook";

const SidebarSearchHook = () => {
    const [items, onPress, pageCount, totalItems, getProducts] = ViewSearchProductsHook();
    
    const [catChecked, setCatChecked] = useState([]);
    const [brandChecked, setBrandChecked] = useState([])

    const dispatch=useDispatch();
    
    //when first load
    useEffect(()=>{
        const get= async ()=>{
            await dispatch(getAllCategory());
            await dispatch(getAllBrand());
        }
        get();
    }, [])
  
    //to get state from redux
    const allCat = useSelector(state => state.allCategory.category)
    const allBrands = useSelector(state => state.allBrand.brand)

    let category =[];
    if(allCat.data)
        category = allCat.data

    let brand =[];
    if(allBrands.data)
        brand = allBrands.data

    var queryCat = "", queryBrand="";

    //when user press any category
    const clickCategoy = (e) => {
        
        let value = e.target.value

        if(value === "0"){
            setCatChecked([])
        }else{
            if(e.target.checked === true)
            {
                setCatChecked([...catChecked, value])
            }else if(e.target.checked === false)
            {
                const newArry = catChecked.filter((e) => e !== value)
                setCatChecked(newArry)
            }
        }

    }

    useEffect(() => {
        queryCat = catChecked.map(val=> "category[]=" + val).join("&")

        localStorage.setItem("catChecked", queryCat)
        setTimeout(() =>{
            getProducts()
        }, 1000)
    }, [catChecked])

    //when user press any brand
    const clickBrand = (e) => {
        let value = e.target.value
        if(value === "0")
        {
            setBrandChecked([])
        }else{
            if(e.target.checked === true)
            {
                setBrandChecked([...brandChecked, value])
            }else if(e.target.checked === false)
            {
                const newArry = brandChecked.filter((e) => e !== value)
                setBrandChecked(newArry)
            }
        }

    }

    useEffect(() => {
        queryBrand = brandChecked.map(val=> "brand[]=" + val).join("&")

        localStorage.setItem("brandChecked", queryBrand)
        setTimeout(() =>{
            getProducts()
        }, 1000)
    }, [brandChecked])

    const [from,setFrom] = useState(0);
    const [to,setTo] = useState(0);

    const priceFrom = (e) => {
        localStorage.setItem("priceFrom", e.target.value)
        setFrom(e.target.value)
    }
    
    const priceTo = (e) => {
        localStorage.setItem("priceTo", e.target.value)
        setTo(e.target.value)
    }

    useEffect(() => {
        setTimeout(() =>{
            getProducts()
        }, 1000)
    }, [from, to])

    return [category,brand,clickCategoy,clickBrand,priceFrom,priceTo];
}

export default SidebarSearchHook