import { useDispatch, useSelector } from 'react-redux';
import { useEffect } from 'react';
import { getAllBrand, getAllBrandPage } from '../../redux/actions/BrandAction';

const AllBrandPageHook = () => {
  
    const dispatch=useDispatch();
    //when first load
    useEffect(()=>{
      dispatch(getAllBrand(4));
    }, [])
  
    //to get state from redux
    const brands = useSelector(state => state.allBrand.brand)
    const loading = useSelector(state => state.allBrand.loading)
    //to get page count
    let pageCount=brands.last_page ?? 0;
  
    //when press page paginatiob
    const getPage=(page)=>{
      dispatch(getAllBrandPage(page));
    }

    return [brands,loading,pageCount,getPage];

}

export default AllBrandPageHook