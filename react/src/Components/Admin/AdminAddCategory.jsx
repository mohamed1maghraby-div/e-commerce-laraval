import { Col, Row, Spinner } from "react-bootstrap";
import AddCategoryHook from "../../hook/category/add-category-hook";
import { ToastContainer } from "react-toastify";

const AdminAddCategory = () => {
    const [ img, name, loading, isPress, handelSubmit, onImageChange, onNameChange ] = AddCategoryHook();

    return (
        <div>
            <Row className="justify-content-start">
                <div className="admin-content-text pb-4">اضف تصنيف جديدة</div>
                <Col sm="8">
                    <div className="text-form pb-2">صورة التصنيف</div>

                    <div>
                        <label htmlFor="upload-photo">
                            <img
                                src={img}
                                alt="fzx"
                                height="100px"
                                width="120px"
                                style={{ cursor: "pointer" }}
                            />
                            <input
                                type="file"
                                name="photo"
                                onChange={onImageChange}
                                id="upload-photo"
                            />
                        </label>
                    </div>

                    <input
                        onChange={onNameChange}
                        value={name}
                        type="text"
                        className="input-form d-block mt-3 px-3"
                        placeholder="اسم التصنيف"
                    />
                </Col>
            </Row>
            <Row>
                <Col sm="8" className="d-flex justify-content-end">
                    <button
                        onClick={handelSubmit}
                        className="btn-save d-inline mt-2"
                    >
                        حفظ التعديلات
                    </button>
                </Col>
            </Row>
            {isPress ? (
                loading ? (
                    <Spinner animation="border" variant="primary" />
                ) : (
                    <h4>تم الانتهاء</h4>
                )
            ) : null}
            <ToastContainer />
        </div>
    );
};

export default AdminAddCategory;
