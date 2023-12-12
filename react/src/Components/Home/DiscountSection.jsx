
import { Col, Container, Row } from 'react-bootstrap'
import laptops from "../../Assets/images/laptops.png";

const DiscountSection = () => {
  return (
    <Container>
        <Row className='discount-backcolor my-3 mx-2 d-flex text-center align-items-center'>
            <Col sm="6">
                <div className='discount-title'>
                    خصم يصل 30% على اجهزة اللاب توب
                </div>
            </Col>
            <Col sm="6">
                <img className='discount-img' src={laptops} alt="" style={{ width: '315px' }}/>
            </Col>
        </Row>
    </Container>
  )
}

export default DiscountSection