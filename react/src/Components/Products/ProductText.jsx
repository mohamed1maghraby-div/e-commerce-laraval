import { Col, Row } from "react-bootstrap";
import { useParams } from 'react-router-dom';
import ViewProductDetailsHook from './../../hook/product/view-product-details-hook';

const ProductText = () => {
      const {id} = useParams(); //to get product id form url

      // eslint-disable-next-line no-unused-vars
      const [item,images] = ViewProductDetailsHook(id);
    return (
        <div>
            <Row className="mt-2">
                <div className="cat-text">{item.category_name} :</div>
            </Row>
            <Row>
                <Col md="8">
                    <div className="cat-title d-inline">
                        آيفون XR بذاكرة سعة 128 جيجابايت ويدعم تقنية 4G LTE مع
                        تطبيق فيس تايم (برودكت) أحمر{" "}
                        <div className="cat-rate d-inline mx-3">{Math.floor(item.reviews_avg_rating)}</div>
                    </div>
                </Col>
            </Row>
            <Row>
                <Col md="8" className="mt-4">
                    <div className="cat-text d-inline">الماركة :</div>
                    <div className="barnd-text d-inline mx-1">سامسنوج </div>
                </Col>
            </Row>
            <Row>
                <Col md="8" className="mt-1 d-flex">
                {
                    item.availableColors ? (item.availableColors.map((color,index) => {
                        return (
                            <div 
                                className="color ms-2 border"
                                style={{ backgroundColor: color }} key={index}
                                >
                                </div>
                                    )
                    })) : null
                }
                    {/*
                        <div className="color ms-2 border"
                            style={{ backgroundColor: "#E52C2C" }}
                        ></div>
                        <div className="color ms-2 border "
                            style={{ backgroundColor: "white" }}
                        ></div>
                        <div className="color ms-2 border"
                            style={{ backgroundColor: "black" }}
                        ></div>
                    */}
                </Col>
            </Row>

            <Row className="mt-4">
                <div className="cat-text">المواصفات :</div>
            </Row>
            <Row className="mt-2">
                <Col md="10">
                    <div className="product-description d-inline">
                        {item.description}
                    </div>
                </Col>
            </Row>
            <Row className="mt-4">
                <Col md="12">
                    <div className="product-price d-inline px-3 py-3 border">
                        {item.price} جنية
                    </div>
                    <div className="product-cart-add px-3 py-3 d-inline mx-3">
                        اضف للعربة
                    </div>
                </Col>
            </Row>
        </div>
    );
};

export default ProductText;
