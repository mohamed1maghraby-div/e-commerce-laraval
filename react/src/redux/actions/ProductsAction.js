import {CREATE_PRODUCTS, GET_ALL_PRODUCTS, GET_PRODUCT_DETALIS, DELETE_PRODUCT, GET_ERROR, UPDATE_PRODUCT} from '../type'
import {useInsertDataWithImage} from '../../hooks/useInsertData'
import useGetData from './../../hooks/useGetData';
import useDeleteData from '../../hooks/useDeleteData';
import { useUpdateDataWithImage } from '../../hooks/useUpdateData';

//create product with pagination
export const createProduct = (formatData) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/categories');
        const response =await useInsertDataWithImage(`/api/v1/products`, formatData);
        dispatch({
            type : CREATE_PRODUCTS,
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

//get all products
export const getAllProducts = (limit) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/categories');
        const response = await useGetData(`/api/v1/products?limit=${limit}`);
        dispatch({
            type : GET_ALL_PRODUCTS,
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

//get all products with pagination with pages number
export const getAllProductsPage = (page,limit) => async (dispatch)=>{
    try{
        //const res = await baseUrl.get('/api/v1/categories');
        const response = await useGetData(`/api/v1/products?page=${page}&limit=${limit}`);
        dispatch({
            type : GET_ALL_PRODUCTS,
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
//get one product with id
export const getProduct = (id) => async (dispatch)=>{
    try{
        const response = await useGetData(`/api/v1/products/${id}`);
        dispatch({
            type : GET_PRODUCT_DETALIS,
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

//delete product with id
export const deleteProduct = (id) => async (dispatch)=>{
    try{
        const response = await useDeleteData(`/api/v1/products/${id}`);
        dispatch({
            type : DELETE_PRODUCT,
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

//update product with id
export const updateProduct = (id, formatData) => async (dispatch)=>{
    try{
        const response = await useUpdateDataWithImage(`/api/v1/products/${id}`, formatData);
        dispatch({
            type : UPDATE_PRODUCT,
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