
import ProductCard from './ProductCard'
import { Container, Row } from 'react-bootstrap'
import SubTitle from '../Utility/SubTitle'

// eslint-disable-next-line react/prop-types
const CardProductsContainer = ({title, btntitle, pathText, products}) => {
  return (
    <Container>
        {products ? (<SubTitle title={title} btntitle={btntitle} pathText={pathText}/>) : null}
        <Row className='my-2 d-flex justify-content-between'>
        {
          products ? (
            // eslint-disable-next-line react/prop-types
            products.map((item, index) => <ProductCard key={index} item={item}/>)
            ) : null
        }
            
        </Row>
    </Container>
  )
}

export default CardProductsContainer