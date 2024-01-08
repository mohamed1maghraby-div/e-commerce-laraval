import { useDispatch, useSelector } from 'react-redux';
import { useEffect } from 'react';
import { getAllBrand } from '../../redux/actions/BrandAction';

const HomeBrandHook = () => {
    const dispatch=useDispatch();

    useEffect(()=>{
      dispatch(getAllBrand());
    }, [])
  
    const brands = useSelector(state => state.allBrand.brand)
    const loading = useSelector(state => state.allBrand.loading)
  
    return [brands, loading];
}

export default HomeBrandHook



