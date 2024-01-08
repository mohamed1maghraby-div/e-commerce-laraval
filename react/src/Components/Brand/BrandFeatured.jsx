import { Container, Row, Spinner } from "react-bootstrap";
import SubTitle from "../Utility/SubTitle";
import BrandCard from "./BrandCard";
import HomeBrandHook from "../../hook/brand/home-brand-hook";

// eslint-disable-next-line react/prop-types
const BrandFeatured = ({ title, btntitle }) => {

    const [brands, loading] = HomeBrandHook();

    return (
        <Container>
            <SubTitle title={title} btntitle={btntitle} pathText="/allbrand" />
            <Row className="my-1 d-flex justify-content-between">
                {loading === false ? (
                    brands.data ? (
                        brands.data.slice(0, 5).map((item, index) => {
                            return (
                                <BrandCard img={item.image} key={index} />
                            );
                        })
                    ) : (
                        <h4>لا توجد تصنيفات</h4>
                    )
                ) : (
                    <Spinner animation="border" variant="primary" />
                )}
            </Row>
        </Container>
    );
};

export default BrandFeatured;
