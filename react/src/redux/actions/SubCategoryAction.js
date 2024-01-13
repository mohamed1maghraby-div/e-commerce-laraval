import {CREATE_SUB_CATEGORY, GET_ERROR,} from '../type'
import {useInsertData} from '../../hooks/useInsertData'

//create subCategory
export const createSubCategory = (data) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/categories');
        const response =await useInsertData(`/api/v1/product_categories`, data);
        dispatch({
            type : CREATE_SUB_CATEGORY,
            payload : response,
            loading:true
        })
    }catch(e){
        dispatch({
            type : GET_ERROR,
            payload : "Error "+ e
        })
    }
}