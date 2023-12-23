import { Col, Container, Row } from "react-bootstrap"
import UserSideBar from "../../../Components/User/UserSideBar"
import UserAllAddresse from "../../../Components/User/Addresse/UserAllAddresse"

const UserAddressePage = () => {
  return (
    <Container>
        <Row className="py-3">
            <Col sm='3' xs='2' md='2'>
                <UserSideBar />
            </Col>
            <Col sm='9' xs='10' md='10'>
                <UserAllAddresse />
            </Col>
        </Row>
    </Container>
  )
}

export default UserAddressePage