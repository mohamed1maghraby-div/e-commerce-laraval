import { Col, Row } from "react-bootstrap"
import { ToastContainer } from "react-toastify";
import AddSubcategoryHook from "../../hook/subcategory/add-subcategory-hook";

const AdminAddSubCategory = () => {

    const [id,name,loading,category,subcategory,handelChange,handelSubmit,onChangeName] = AddSubcategoryHook();

  return (
    <div>
        <Row className="justify-content-start">
            <div className="admin-content-text pb-4">اضف تصنيف فرعى جديدة</div>
            <Col sm='8'>
                <input
                value={name}
                onChange={onChangeName}
                    type="text"
                    className="input-form d-block mt-3 px-3"
                    placeholder="اسم التصنيف الفرعى"
                    />
                <select name="languages" id="lang" className="select mt-3 px-2" onChange={handelChange}>
                    <option value='0'>أختر تصنيف رئيسى</option>
                    {
                        category.data ? (category.data.map((item, index)=>{
                            return ( <option value={item.id} key={index}>{item.name}</option>)
                        })) : null
                    }
                   
                </select>
            </Col>
        </Row>
        <Row>
            <Col sm='8' className="d-flex justify-content-end">
                <button onClick={handelSubmit} className="btn-save d-inline mt-2">حفظ التعديلات</button>
            </Col>
            <ToastContainer />
        </Row>
    </div>
  )
}

export default AdminAddSubCategory