import { createSubCategory } from "../../redux/actions/SubCategoryAction";
import notify from './../../hook/useNotification';
import { getAllCategory } from './../../redux/actions/CategoryAction';
import { useDispatch, useSelector } from 'react-redux';
import { useEffect, useState } from "react";


const AddSubcategoryHook = () => {

    const dispatch = useDispatch();
    useEffect(()=>{
        if(!navigator.onLine) //navigator.onLine & navigator.offline
        {
            notify("لا يوجد اتصال بالانترنت", "warn")
            return;
         }
        dispatch(getAllCategory());
    }, [])

    const [id, setID] = useState('0');
    const [name, setName] = useState('');
    const [loading, setLoading] = useState(true);

    //get last category state from redux
    const category = useSelector(state => state.allCategory.category);
    
    //get last category state from redux
    const subcategory = useSelector(state => state.subcategory.subcategory);

    // on change drop down category
    const handelChange = (e) => {
        setID(e.target.value)
    }

    const onChangeName = (e)=>{
        e.presist();
        setName(e.target.value)
    }

    //on save data
    const handelSubmit = async(e) => {
        e.preventDefault();

        if(!navigator.onLine) //navigator.onLine & navigator.offline
        {
           notify("لا يوجد اتصال بالانترنت", "warn")
           return;
        }
        if(id==="0"){
            notify("من فضلك اختر تصنيف رئيسى", "warn")
            return;
        }

        if(id===""){
            notify("من فضلك أدخل التصنيف.", "warn")
            return;
        }
        setLoading(true)
        await dispatch(createSubCategory({
            name, //same as name: name
            parent_id: id
        }))
        setLoading(false)

    }

    useEffect(()=>{
        if(loading === false){
            setName("")
            setID("0")
            if(subcategory){
                if(subcategory.status === 201){
                    notify("تم الأضافة بنجاح.", "success")
                }else{
                    notify("هناك مشكلة فى عملية الأضافة.", "error")
                }
            }
            setLoading(true)
        }
    }, [loading])

    return [id,name,loading,category,subcategory,handelChange,handelSubmit,onChangeName]

}

export default AddSubcategoryHook