
import { Container } from 'react-bootstrap'
import CategoryHeader from '../../Components/Category/CategoryHeader'
import ProductDetalis from '../../Components/Products/ProductDetalis'
import RateContainer from '../../Components/Rate/RateContainer'

const ProductDetalisPage = () => {
  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryHeader />
        <Container>
            <ProductDetalis />
            <RateContainer />
        </Container>
    </div>
  )
}

export default ProductDetalisPage