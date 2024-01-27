/* eslint-disable react/prop-types */
import { Button, Card, Col, Modal, Row } from "react-bootstrap";
import { Link } from "react-router-dom";
import prod1 from '../../Assets/images/prod1.png';
import { useState } from "react";
import { useDispatch } from "react-redux";
import { deleteProduct } from "../../redux/actions/ProductsAction";


const AdminAllProductsCard = ({item}) => {

    const [show, setShow] = useState(false);
    const handleClose =() => setShow(false);
    const handleShow =() => setShow(true);

    const dispatch = useDispatch();
    const handleDelete = async () =>{
        await dispatch(deleteProduct(item.id))
        setShow(false)
        window.location.reload()
    }


    return (
        <Col xs="12" sm="6" md="5" lg="4" className="d-flex">

        <Modal show={show} onHide={handleClose}>
            <Modal.Header >
                <Modal.Title><div className="font">تأكيد الحذف</div></Modal.Title>
            </Modal.Header>
            <Modal.Body><div className="font">هل أنت متأكد من عملية حذف المنتج</div></Modal.Body>
            <Modal.Footer>
                <Button className="font" variant="success" onClick={handleClose}>
                    تراجع
                </Button>
                <Button  className="font" variant="dark" onClick={handleDelete}>
                    حذف
                </Button>
            </Modal.Footer>
        </Modal>

            <Card
                className="my-2"
                style={{
                    width: "100%",
                    height: "350px",
                    borderRadius: "8px",
                    border: "none",
                    backgroundColor: "#FFFFFF",
                }}
            >
                <Row className="d-flex justify-content-center px-2">
                    <Col className=" d-flex justify-content-between">
                        <div onClick={handleShow} className="d-inline item-delete-edit">ازاله</div>
                        <Link to={`/admin/editproduct/${item.id}`} style={{ textDecoration: "none" }}>
                            <div className="d-inline item-delete-edit">تعديل</div>
                        </Link>
                    </Col>
                </Row>
                <Link to={`/products/${item.id}`} style={{ textDecoration: "none" }}>
                    <Card.Img
                        style={{ height: "228px", width: "100%" }}
                        src={prod1}
                    />
                    <Card.Body>
                        <Card.Title>
                            <div className="card-title">
                                {item.name}
                            </div>
                        </Card.Title>
                        <Card.Text>
                            <div className="d-flex justify-content-between">
                                <div className="card-rate">{Math.floor(item.reviews_avg_rating)}</div>
                                <div className="d-flex">
                                    <div className="card-currency mx-1">
                                        جنيه
                                    </div>
                                    <div className="card-price">{item.price}</div>
                                </div>
                            </div>
                        </Card.Text>
                    </Card.Body>
                </Link>
            </Card>
        </Col>
    );
};

export default AdminAllProductsCard;
