import { Card, Col } from 'react-bootstrap'

// eslint-disable-next-line react/prop-types
const BrandCard = ({img}) => {
  return (
    <Col
    xs="6"
    sm="6"
    md="4"
    lg="2"
    className='my-2 d-flex justify-content-center'
    >
    <Card 
    className='my-1'
    style={{ 
        width: "100%",
        height: "151px",
        borderRedius: "8px",
        border: "none",
        backgroundColor: "#ffffff",
     }}>
        <Card.Img style={{ width: "100%", height: "151px" }} src={img} />
    </Card>

    </Col>
  )
}

export default BrandCard