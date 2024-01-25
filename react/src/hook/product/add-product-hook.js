import { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { getAllCategory } from './../../redux/actions/CategoryAction';
import { getAllBrand } from '../../redux/actions/BrandAction';
import { createProduct } from '../../redux/actions/ProductsAction'
import { getOneCategory } from '../../redux/actions/SubCategoryAction'
import notify from './../../hook/useNotification';

const AdminAddProductHook = () => {

    
    const dispatch = useDispatch();
    useEffect(()=>{
        dispatch(getAllCategory());
        dispatch(getAllBrand());
    }, [])

    //get last category state from redux
    const categories = useSelector(state => state.allCategory.category);

    //get last brand state from redux
    const brands = useSelector(state => state.allBrand.brand);

    //get last sub cat state from redux
    const subCat = useSelector(state => state.subcategory.subcategory);


    const onSelect = (selectedList) => {
        setSelectedSubID(selectedList)
    }

    const onRemove = (selectedList) => {
        setSelectedSubID(selectedList)
    }

    const [options, setOptions] = useState([]);

    //values images products
    const [images, setImages] = useState([]);
    
    useEffect(()=>{
        /* console.log(images) */
    }, [images])
    
    //values state
    const [prodName, setProdName] = useState('');
    const [prodDescription, setProdDescription] = useState('');
    const [priceBefore, setPriceBefore] = useState('السعر قبل الخصم');
    const [priceAfter, setPriceAfter] = useState('السعر بعد الخصم');
    const [qty, setQty] = useState('الكمية المتاحة');
    const [catID, setCatID] = useState('');
    const [brandID, setBrandID] = useState('');
    // eslint-disable-next-line no-unused-vars
    const [subCatID, setSubCatID] = useState([]);
    const [selectedSubID, setSelectedSubID] = useState([]);
    const [loading, setLoading] = useState(true);

    //to change name state
    const onChangeProdName = (event) => {
        event.persist();
        setProdName(event.target.value)
    }
    //to change desc state
    const onChangeDescName = (event) => {
        event.persist();
        setProdDescription(event.target.value)
    }
    //to change PriceBefore state
    const onChangePriceBefore = (event) => {
        event.persist();
        setPriceBefore(event.target.value)
    }
    //to change PriceBefore state
    const onChangePriceAfter = (event) => {
        event.persist();
        setPriceAfter(event.target.value)
    }
    //to change qty state
    const onChangeQty = (event) => {
        event.persist();
        setQty(event.target.value)
    }
    //to change color state
    const onChangeColor = (event) => {
        event.persist();
        setShowColor(!showColor)
    }

    //to show hide color picker
    const [showColor, setShowColor] = useState(false);
    //to store all get colors
    const [colors, setColors] = useState([]);
    //when choose new color
    const handleChangeComplete = (color) => {
        setColors([...colors, color.hex])
        setShowColor(!showColor)
    }
    //to remove color from array
    const removeColor =(color)=>{
        const newColors = colors.filter((e)=> e !== color)
        setColors(newColors)
    }
    
    //when select category store id
    const onSelectCategory= async (e)=>{
        if(e.target.value != 0){
            await dispatch(getOneCategory(e.target.value))
        }
        setCatID(e.target.value)

    }

    useEffect(()=>{
        console.log(subCat)
        if(catID != 0){
            if(subCat){
                setOptions(subCat)
            }
        }
    }, [catID])

    //when select brand store id
    const onSelectBrand=(e)=>{
        setBrandID(e.target.value)
    }

    //to convert base 64 to file
    /* function dataURLtoFile(dataurl, filename){
        var arr = dataurl.splite(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
            
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, {type:mime});
    } */

    //to save data
    const handelSubmit = async (e) => {
        e.preventDefault();

        if(catID === 0 || prodName === '' || prodDescription === '' || images.length <= 0 || priceBefore <= 0)
        {
            notify("من فضلك أكمل البيانات.", "warn")
            return;
        }
        /* 
            convert base 64 image to file
            const imgCover = dataURLtoFile(images[0], Math.random() + ".png")
            convert array of base 64 images to file
            const itemImages=Array.from(Array(Object.keys(images).length).keys()).map(
                (item, index) =>{
                    return dataURLtoFile(images[index], Math.random() + ".png")
                }
            )
        */

        /* console.log(images) */

        const formData = new FormData();
        formData.append("name", prodName);
        formData.append("description", prodDescription);
        formData.append("quantity", qty);
        formData.append("price", priceBefore);
        formData.append("images[]", images[0]); //images[0]
        formData.append("product_category_id", catID);
        formData.append("brand", brandID);
        formData.append("status", 1);
        formData.append("featured", 1);

        //to send colors
        colors.map((color)=>formData.append("availableColors[]", color));
        selectedSubID.map((item)=>formData.append("subcategories[]", item.id));

        setLoading(true)
        await dispatch(createProduct(formData));
        setLoading(false)
    }

    //get create message
    const product = useSelector(state => state.allproducts.products);

    useEffect(()=>{
        if(loading == false){
            setCatID(0)
            setColors([])
            setImages([])
            setProdName('')
            setProdDescription('')
            setPriceBefore('السعر قبل الخصم')
            setPriceAfter('السعر بعد الخصم')
            setQty('الكمية المتاحة')
            setBrandID('')
            setSelectedSubID([])
            setTimeout(()=> setLoading(true), 1500)

            if(product){
                if(product.status === 201){
                    notify("تم الأضافة بنجاح.", "success")
                }else{
                    notify("هناك مشكلة ما.","error")
                }
            }
        }
    }, [loading])

    
    return [onChangeProdName, onChangeDescName, onChangePriceBefore, onChangePriceAfter, onChangeQty, onChangeColor,showColor,categories,brands,priceAfter,images,setImages,onRemove,options,
    handleChangeComplete,removeColor,onSelectCategory,handelSubmit,onSelectBrand,colors,priceBefore,
    qty,prodDescription,prodName,onSelect];

}

export default AdminAddProductHook