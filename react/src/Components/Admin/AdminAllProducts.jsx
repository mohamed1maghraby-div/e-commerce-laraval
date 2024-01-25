import { Row } from "react-bootstrap";
import AdminAllProductsCard from "./AdminAllProductsCard";

// eslint-disable-next-line react/prop-types
const AdminAllProducts = ({products}) => {
    return (
        <div>
            <div className="admin-content-text">ادارة جميع المنتجات</div>
            <Row className="justify-content-start">
            {
                products ? (
                    // eslint-disable-next-line react/prop-types
                    products.map((item,index) => <AdminAllProductsCard key={index} item={item}/>)
                ) : <h4>لا توجد منتجات حتى الان</h4>
            }
            </Row>
        </div>
    );
};

export default AdminAllProducts;
