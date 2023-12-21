
import { Container } from 'react-bootstrap'
import CategoryHeader from '../../Components/Category/CategoryHeader'
import ProductDetalis from '../../Components/Products/ProductDetalis'
import RateContainer from '../../Components/Rate/RateContainer'
import CardProductsContainer from './../../Components/Products/CardProductsContainer';

const ProductDetalisPage = () => {
  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryHeader />
        <Container>
            <ProductDetalis />
            <RateContainer />
            <CardProductsContainer title='منتجات قد تعجبك'/>
        </Container>
    </div>
  )
}

export default ProductDetalisPage