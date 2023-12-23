import { Col, Container, Row } from "react-bootstrap"
import UserSideBar from "../../../Components/User/UserSideBar"
import UserEditAddresse from "../../../Components/User/Addresse/UserEditAddresse"

const UserEditAddressePage = () => {
  return (
    <Container>
        <Row className="py-3">
            <Col sm='3' xs='2' md='2'>
                <UserSideBar />
            </Col>
            <Col sm='9' xs='10' md='10'>
                <UserEditAddresse />
            </Col>
        </Row>
    </Container>
  )
}

export default UserEditAddressePage