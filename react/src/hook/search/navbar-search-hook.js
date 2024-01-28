import { useState } from "react"


const NavbarSearchHook = () => {
    const [searchKeyword, setSearchKeyword] = useState('')
    const onChangeSearch=(e)=>{
        setSearchKeyword(e.target.value)
    }
    return [searchKeyword,onChangeSearch]
}

export default NavbarSearchHook