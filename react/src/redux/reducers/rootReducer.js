import { combineReducers } from "redux";
import categoryReducer from './categoryReducer'
import brandReducer from "./brandReducer";
import subcategoryReducer from "./subCategoryReducer";

export default combineReducers ({
    allCategory:categoryReducer,
    allBrand:brandReducer,
    subcategory:subcategoryReducer,
})