import { Row } from "react-bootstrap"
import UserAllOrderItem from "./UserAllOrderItem"


const UserAllOrders = () => {
  return (
    <div>
        <div className="admin-content-text pb-4">اهلا محمد على</div>
        <Row className="justify-content-between">
            <UserAllOrderItem />
            <UserAllOrderItem />
        </Row>
    </div>
  )
}

export default UserAllOrders