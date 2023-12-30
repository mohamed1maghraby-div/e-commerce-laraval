import { useEffect } from 'react';
import CategoryContainer from '../../Components/Category/CategoryContainer'
import Pagination from '../../Components/Utility/Pagination'
import { useDispatch, useSelector } from 'react-redux';
import { getAllCategory } from '../../redux/actions/CategoryAction';

const AllCategoryPage = () => {

  const dispatch=useDispatch();

  useEffect(()=>{
    dispatch(getAllCategory());
  }, [])

  const data = useSelector(state => state.allCategory.category)
  const loading = useSelector(state => state.allCategory.loading)
  console.log(data);
  console.log(loading);

  /* const get = async () => {
    const res = await baseUrl.get("/api/v1/categories")
    console.log(res.data)
  }
  useEffect(()=>{
    get();
  }, []) */
  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryContainer />
        <Pagination />
    </div>
  )
}

export default AllCategoryPage