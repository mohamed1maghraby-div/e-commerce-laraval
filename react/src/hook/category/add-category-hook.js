import avatar from '../../Assets/images/avatar.png'
import { useEffect, useState } from "react"
import {useDispatch, useSelector} from 'react-redux'
import { createCategory } from "../../redux/actions/CategoryAction"
import notify from '../../hook/useNotification'

const AddCategoryHook = () => {
  
    const dispatch = useDispatch();
    const[img, setImg] = useState(avatar)
    const[name, setName] = useState('')
    const[selectedFile, setselectedFile] = useState(null)
    const[loading, setLoading] = useState(true)
    const[isPress, setIsPress] = useState(false)

    //to change name state
    const onNameChange = (event) => {
        setName(event.target.value)
    }

    //when Image change save it
    const onImageChange = (event) =>{
        if(event.target.files && event.target.files[0])
        {
            setImg(URL.createObjectURL(event.target.files[0]))
            setselectedFile(event.target.files[0])
        }
    }

    const res = useSelector(state => state.allCategory.category)


    //save data in database
    const handelSubmit = async (event) => {
        event.preventDefault()

        // validation
        if(name==="" || selectedFile===null)
        {
            console.log('من فضلك اكمل البيانات.')
            notify('من فضلك اكمل البيانات', 'warn');
            return;
        }

        const formData = new FormData();
        formData.append("name", name)
        formData.append("status", 1)
        /* formData.append("parent_id", null) */
        formData.append("cover", selectedFile)

        setLoading(true)
        setIsPress(true)
        await dispatch(createCategory(formData))
        setLoading(false)
    }

    useEffect(()=>{
        if(loading === false){
            setName('');
            setImg(avatar);
            setselectedFile(null);
            console.log('تم الانتهاء')
            setLoading(true)
            setIsPress(false)
            console.log(res);
            if(res.status ===201){
                notify(res.msg, "success");
            }else{
                notify('هناك مشكلة فى عملية الأضافة.', 'error');
            }

        }
    }, [loading])

    return [img,name,loading,isPress,handelSubmit,onImageChange,onNameChange]

}

export default AddCategoryHook