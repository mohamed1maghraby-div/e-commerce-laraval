import { useDispatch, useSelector } from 'react-redux';
import { useEffect } from 'react';
import { getAllCategory } from '../../redux/actions/CategoryAction';

const HomeCategoryHook = () => {
    const dispatch=useDispatch();

  useEffect(()=>{
    dispatch(getAllCategory());
  }, [])

  const categories = useSelector(state => state.allCategory.category)
  const loading = useSelector(state => state.allCategory.loading)

  const colors = ['#FFD3E8', '#F4DBAS', '#55CFDF', '#FF6262', '#0034FF', '#FFD3E8'];

  return [categories, loading, colors];
}

export default HomeCategoryHook