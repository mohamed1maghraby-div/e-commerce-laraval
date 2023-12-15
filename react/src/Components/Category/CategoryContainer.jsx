
import { Container, Row } from 'react-bootstrap'
import clothe from "../../Assets/images/clothe.png";
import cat2 from "../../Assets/images/cat2.png";
import labtop from "../../Assets/images/labtop.png";
import sale from "../../Assets/images/sale.png";
import pic from "../../Assets/images/pic.png";
import CategoryCard from './CategoryCard';

const CategoryContainer = () => {
  return (
    <Container>
    <div className='admin-content-text mt-2'>كل التصنيفات</div>
        <Row className='my-2 d-flex justify-content-between'>
          <CategoryCard img={clothe} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={cat2} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={labtop} title="اجهزة منزلية" background="#0034ff"/>
          <CategoryCard img={sale} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={pic} title="اجهزة منزلية" background="#ff5262"/>
          <CategoryCard img={sale} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={clothe} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={cat2} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={labtop} title="اجهزة منزلية" background="#0034ff"/>
          <CategoryCard img={sale} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={pic} title="اجهزة منزلية" background="#ff5262"/>
          <CategoryCard img={sale} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={clothe} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={cat2} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={labtop} title="اجهزة منزلية" background="#0034ff"/>
          <CategoryCard img={sale} title="اجهزة منزلية" background="#F4DBA4"/>
          <CategoryCard img={pic} title="اجهزة منزلية" background="#ff5262"/>
          <CategoryCard img={sale} title="اجهزة منزلية" background="#F4DBA4"/>
        </Row>
    </Container>
  )
}

export default CategoryContainer