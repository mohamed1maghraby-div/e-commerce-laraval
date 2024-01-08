import Pagination from '../../Components/Utility/Pagination'
import BrandContainer from '../../Components/Brand/BrandContainer'
import AllBrandPageHook from '../../hook/brand/all-brand-page-hook'

const AllBrandPage = () => {

  const [brands,loading,pageCount,getPage] = AllBrandPageHook();

  return (
    <div style={{ minHeight: '670px' }}>
        <BrandContainer data={brands.data} loading={loading}/>
        <Pagination pageCount={pageCount} onPress={getPage}/>
    </div>
  )
}

export default AllBrandPage