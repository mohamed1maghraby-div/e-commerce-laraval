import { Row } from "react-bootstrap"
import Pagination from "../Utility/Pagination"
import ProductCard from "../Products/ProductCard"


const UserFavoriteProducts = () => {
  return (
    <div>
    <div className="admin-content-text pb-4">قائمة المفضلة</div>
    <Row className='justify-content-start'>
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
        <ProductCard />
    </Row>
    <Pagination />
</div>
  )
}

export default UserFavoriteProducts