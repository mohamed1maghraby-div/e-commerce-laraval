
import { Container } from 'react-bootstrap'
import CategoryHeader from '../../Components/Category/CategoryHeader'
import ProductDetalis from '../../Components/Products/ProductDetalis'
import RateContainer from '../../Components/Rate/RateContainer'
import CardProductsContainer from './../../Components/Products/CardProductsContainer'
import ViewHomeProductsHook from '../../hook/product/view-homeproducts-hook'

const ProductDetalisPage = () => {
  
  const [items] = ViewHomeProductsHook();

  return (
    <div style={{ minHeight: '670px' }}>
        <CategoryHeader />
        <Container>
            <ProductDetalis />
            <RateContainer />
            {
              items ? (<CardProductsContainer products={items} title='منتجات قد تعجبك'/>) : null
            }
            
        </Container>
    </div>
  )
}

export default ProductDetalisPage