import {GET_ALL_CATEGORY, GET_ERROR} from '../type'
import useGetData from '../../hooks/useGetData'

export const getAllCategory = () => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/categories');
        const response =await useGetData('/api/v1/categories');
        dispatch({
            type : GET_ALL_CATEGORY,
            payload : response
        })
    }catch(e){
        dispatch({
            type : GET_ERROR,
            payload : "Error "+ e
        })
    }
}