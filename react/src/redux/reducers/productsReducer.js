import {CREATE_PRODUCTS, GET_ALL_PRODUCTS, GET_PRODUCT_DETALIS, DELETE_PRODUCT, GET_ERROR} from '../type'

const inital={
    products: [],
    allProducts: [],
    oneProduct: [],
    deleteProduct: [],
    loading: true,
}
const productsReducer = (state=inital, action) => {
    switch(action.type){
        case CREATE_PRODUCTS:
            return {
                ...state,
                products:action.payload,
                loading:false
            }
        case GET_ALL_PRODUCTS:
            return {
                ...state,
                allProducts:action.payload,
                loading:false
            }
        case GET_PRODUCT_DETALIS:
            return {
                oneProduct:action.payload,
                loading:false
            }
        case DELETE_PRODUCT:
            return {
                ...state,
                deleteProduct:action.payload,
                loading:false
            }
        case GET_ERROR:
            return {
                loading: true,
                products:action.payload
            }
        default :
            return state;
    }
}
export default productsReducer