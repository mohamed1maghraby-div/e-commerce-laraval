import CategoryContainer from '../../Components/Category/CategoryContainer'
import Pagination from '../../Components/Utility/Pagination'
import AllCategoryPageHook from '../../hook/category/all-category-page-hook'

const AllCategoryPage = () => {
  const [categories,loading,pageCount,getPage] = AllCategoryPageHook();
  
  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryContainer data={categories.data} loading={loading}/>
        {pageCount > 1 ? (<Pagination pageCount={pageCount} onPress={getPage}/>) : null}
        
    </div>
  )
}

export default AllCategoryPage