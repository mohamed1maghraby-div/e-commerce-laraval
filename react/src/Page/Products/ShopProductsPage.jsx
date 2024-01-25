import { Col, Container, Row } from "react-bootstrap"
import CategoryHeader from "../../Components/Category/CategoryHeader"
import SearchCountResult from "../../Components/Utility/SearchCountResult"
import SideFilter from "../../Components/Utility/SideFilter"
import CardProductsContainer from './../../Components/Products/CardProductsContainer';
import Pagination from './../../Components/Utility/Pagination';
import ViewSearchProductsHook from "../../hook/product/view-search-products-hook";


const ShopProductsPage = () => {

  const [items] = ViewSearchProductsHook();

  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryHeader />
        <Container>
          <SearchCountResult title={`هناك ${items.length} نتيجة بحث.`} />
          
          <Row className="d-flex flex-row">
            <Col sm='2' xs='2' md='1' className="d-flex">
              <SideFilter />
            </Col>
            <Col sm='10' xs='10' md='11'>
              <CardProductsContainer products={items} title='' btntitle='' />
            </Col>
          </Row>
          <Pagination />
        </Container>
    </div>
  )
}

export default ShopProductsPage