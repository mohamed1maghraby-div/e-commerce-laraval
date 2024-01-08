import { Container, Row } from 'react-bootstrap'
import BrandCard from './BrandCard'
import { Spinner } from 'react-bootstrap';

// eslint-disable-next-line react/prop-types
const BrandContainer = ({data, loading}) => {

  

  return (
    <Container>
        <div className='admin-content-text mt-2'>كل الماركات</div>
        <Row className='my-1 d-flex justify-content-between'>
        {
          loading === false ? (
            data ? (
              // eslint-disable-next-line react/prop-types
              data.map((item, index)=>{
                return (<BrandCard img={item.image} key={index} />)
              })
            ) : <h4>لا يوجد ماركات</h4>
          ) : <Spinner animation="border" variant="primary" />
        }
            
        </Row>
    </Container>
  )
}

export default BrandContainer