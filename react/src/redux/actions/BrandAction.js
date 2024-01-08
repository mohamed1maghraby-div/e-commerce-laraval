import {GET_ALL_BRAND, GET_ERROR, CREATE_BRAND} from '../type'
import useGetData from '../../hooks/useGetData'
import {useInsertDataWithImage} from '../../hooks/useInsertData'

//get all brand
export const getAllBrand = (limit) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/brands');
        const response =await useGetData(`/api/v1/brands?limit=${limit}`);
        dispatch({
            type : GET_ALL_BRAND,
            payload : response
        })
    }catch(e){
        dispatch({
            type : GET_ERROR,
            payload : "Error "+ e
        })
    }
}

//get all brand with pagination
export const getAllBrandPage = (page) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/brands');
        const response =await useGetData(`/api/v1/brands?page=${page}`);
        dispatch({
            type : GET_ALL_BRAND,
            payload : response
        })
    }catch(e){
        dispatch({
            type : GET_ERROR,
            payload : "Error "+ e
        })
    }
}

//create brand
export const createBrand = (formData) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/brands');
        const response =await useInsertDataWithImage(`/api/v1/brands`, formData);
        dispatch({
            type : CREATE_BRAND,
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