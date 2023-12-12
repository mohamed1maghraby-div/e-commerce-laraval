
import ProductCard from './ProductCard'
import { Container, Row } from 'react-bootstrap'
import SubTitle from '../Utility/SubTitle'

// eslint-disable-next-line react/prop-types
const CardProductsContainer = ({title, btntitle}) => {
  return (
    <Container>
        <SubTitle title={title} btntitle={btntitle}/>
        <Row className='my-2 d-flex justify-content-between'>
            <ProductCard />
            <ProductCard />
            <ProductCard />
            <ProductCard />
        </Row>
    </Container>
  )
}

export default CardProductsContainer