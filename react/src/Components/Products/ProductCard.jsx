/* eslint-disable react/prop-types */
import {Col, Card} from 'react-bootstrap';
import favoff from "../../Assets/images/fav-off.png";
import rate from "../../Assets/images/rate.png";
import { Link } from 'react-router-dom';

const ProductCard = ({item}) => {
  return (
    <Col sx="6" sm="6" md="4" lg="3" className='d-flex'>
        <Card 
            className='my-2'
            style={{ 
                width: '100%',
                height: '345px',
                borderRadius: '8px',
                border: 'none',
                backgroundColor: '#FFFFFF',
                boxShadow: '0 2px 2px 0 rgba(151,151,151,0.5)'
                }}>

                <Link to={`/products/${item.id}`} style={{ textDecoration: 'none' }}>
                    <Card.Img style={{ height:"228px", width: "100%" }} src={item.first_media.file_name} />
                </Link>
                    <div className='d-flex justify-content-end mx-2'>
                        <img 
                            src={favoff}
                            alt=""
                            className='text-center'
                            style={{ 
                                height: "24px",
                                width: "26px",
                            }}
                            />
        </div>
        <Card.Body>
            <Card.Title>
                 <div className='card-title'>{item.name} </div>
            </Card.Title>
            <Card.Text>
            <div className='d-flex justify-content-between'>
                <div className='d-flex'>
                    <img
                        className=''
                        src={rate}
                        alt=""
                        height="16px"
                        width="16px"
                    />
                    <div className='card-rate mx-2'>4.5</div>
                </div>
                <div className='d-flex'>
                    <div className='card-price'>{item.price}</div>
                    <div className='card-price'>جنية</div>
                </div>
            </div>
            </Card.Text>
        </Card.Body>
        </Card>
    </Col>
  )
}

export default ProductCard