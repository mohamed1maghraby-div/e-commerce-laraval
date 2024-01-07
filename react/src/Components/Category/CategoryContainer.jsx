
import { Container, Row, Spinner } from 'react-bootstrap'
import CategoryCard from './CategoryCard';
import baseUrl from '../../Api/baseURL';

// eslint-disable-next-line react/prop-types
const CategoryContainer = ({data, loading}) => {

  
  const colors = ['#FFD3E8', '#F4DBAS', '#55CFDF', '#FF6262', '#0034FF', '#FFD3E8'];
  return (
    <Container>
    <div className='admin-content-text mt-2'>كل التصنيفات</div>
        <Row className='my-2 d-flex justify-content-between'>
          {
            loading===false ? (
              data ? (
                // eslint-disable-next-line react/prop-types
                data.map((item, index)=>{
                  console.log(item.name)
              return (<CategoryCard title={item.name} img={'http://ecommerce.test' + item.cover} key={index} background={colors[Math.floor(Math.random() * 5) +1]}/>)
              })
              ) : <h4>لا يوجد تصنيفات</h4>
            ): <Spinner animation="border" variant="primary" />
          }
        </Row>
    </Container>
  )
}

export default CategoryContainer