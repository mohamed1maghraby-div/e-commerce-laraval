import { Col, Container, Row } from "react-bootstrap"
import CategoryHeader from "../../Components/Category/CategoryHeader"
import SearchCountResult from "../../Components/Utility/SearchCountResult"
import SideFilter from "../../Components/Utility/SideFilter"
import CardProductsContainer from './../../Components/Products/CardProductsContainer';
import Pagination from './../../Components/Utility/Pagination';
import ViewSearchProductsHook from "../../hook/product/view-search-products-hook";


const ShopProductsPage = () => {

  const [items, onPress, pageCount, totalItems, getProducts] = ViewSearchProductsHook();

  if(items)
    console.log(items)
  
  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryHeader />
        <Container>
          <SearchCountResult onClick={getProducts} title={`هناك ${totalItems} نتيجة بحث.`} />
          
          <Row className="d-flex flex-row">
            <Col sm='2' xs='2' md='1' className="d-flex">
              <SideFilter />
            </Col>
            <Col sm='10' xs='10' md='11'>
              <CardProductsContainer products={items} title='' btntitle='' />
            </Col>
          </Row>
          {
            pageCount > 1 ? (<Pagination pageCount={pageCount} onPress={onPress}/>) : null
          }
        </Container>
    </div>
  )
}

export default ShopProductsPage