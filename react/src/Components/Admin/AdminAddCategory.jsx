import { Col, Row } from "react-bootstrap"
import avatar from '../../Assets/images/avatar.png'

const AdminAddCategory = () => {
  return (
    <div>
        <Row className="justify-content-start">
            <div className="admin-content-text pb-4">اضف تصنيف جديدة</div>
            <Col sm='8'>
                <div className="text-form pb-2">صورة التصنيف</div>
                <img src={avatar} alt='' height='100px' width='120px' />
                <input
                    type="text"
                    className="input-form d-block mt-3 px-3"
                    placeholder="اسم التصنيف"
                    />
            </Col>
        </Row>
        <Row>
            <Col sm='8' className="d-flex justify-content-end">
                <button className="btn-save d-inline mt-2">حفظ التعديلات</button>
            </Col>
        </Row>
    </div>
  )
}

export default AdminAddCategory