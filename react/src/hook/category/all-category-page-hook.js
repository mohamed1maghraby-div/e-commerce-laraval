import { useDispatch, useSelector } from 'react-redux';
import { useEffect } from 'react';
import { getAllCategory } from '../../redux/actions/CategoryAction';
import { getAllCategoryPage } from '../../redux/actions/CategoryAction';

const AllCategoryPageHook = () => {
  
    const dispatch=useDispatch();
    //when first load
    useEffect(()=>{
      dispatch(getAllCategory(2));
    }, [])
  
    //to get state from redux
    const categories = useSelector(state => state.allCategory.category)
    const loading = useSelector(state => state.allCategory.loading)
    //to get page count
    let pageCount=categories.last_page ?? 0;
  
    //when press page paginatiob
    const getPage=(page)=>{
      dispatch(getAllCategoryPage(page));
    }

    return [categories,loading,pageCount,getPage];

}

export default AllCategoryPageHook