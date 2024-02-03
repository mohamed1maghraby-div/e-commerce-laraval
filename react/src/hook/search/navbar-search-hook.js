import { useEffect, useState } from "react"
import ViewSearchProductsHook from "../product/view-search-products-hook";


const NavbarSearchHook = () => {
    const [items, onPress, pageCount, totalItems, getProducts] = ViewSearchProductsHook();
    const [searchKeyword, setSearchKeyword] = useState('')

    //when user type search word
    const onChangeSearch=(e)=>{
      localStorage.setItem("searchWord", e.target.value) // to don't lose search data when reload page
      setSearchKeyword(e.target.value)
    }

    // to delay search resault for a while
    useEffect(()=>{

      setTimeout(()=>{
        getProducts();
      }, 1000);

    }, [searchKeyword])

    return [searchKeyword,onChangeSearch]
}

export default NavbarSearchHook