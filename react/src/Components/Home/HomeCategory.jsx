import { Container, Row, Spinner } from 'react-bootstrap'
import SubTitle from '../Utility/SubTitle'
import CategoryCard from '../Category/CategoryCard'
import clothe from "../../Assets/images/clothe.png";
import HomeCategoryHook from '../../hook/category/home-category-hook'

const HomeCategory = () => {

 const [categories, loading, colors] = HomeCategoryHook();

  return (
    <Container>
        <SubTitle title="التصنيفات" btntitle={"المزيد"} pathText='/allcategory'/>
        <Row className='my-2 d-flex justify-content-between'>
        {
          loading === false ?(
            categories.data ? (
            categories.data.slice(0, 5).map((item, index)=>{
              return (<CategoryCard img={clothe} title={item.name} key={index} background={colors[Math.floor(Math.random() * 5) +1]} />)
            })
            ) : <h4>لا توجد تصنيفات</h4>
          ) : <Spinner animation="border" variant="primary" />
        }
        </Row>
    </Container>
  )
}

export default HomeCategory