import { Col, Row } from 'react-bootstrap'
import avatar from '../../Assets/images/avatar.png'
import add from '../../Assets/images/add.png'
import Dropzone from 'react-dropzone'
import { CompactPicker } from 'react-color'
import { ToastContainer } from 'react-toastify'
import Multiselect from 'multiselect-react-dropdown'
import { useParams } from 'react-router-dom'
import AdminEditProductHook from '../../hook/product/edit-product-hook'

const AdminEditProduct = () => {
    const {id} = useParams();

    // eslint-disable-next-line no-unused-vars
    const [catID,onChangeProdName, onChangeDescName, onChangePriceBefore, onChangePriceAfter, onChangeQty, onChangeColor,showColor,categories,brands,priceAfter,images,setImages,onRemove,options,
        handleChangeComplete,removeColor,onSelectCategory,handelSubmit,onSelectBrand,colors,priceBefore,
        qty,prodDescription,prodName,onSelect] = AdminEditProductHook(id);
        
  return (
      <div>
          <Row className="justify-content-start ">
              <div className="admin-content-text pb-4"> تعديل المنتج </div>
              <Col sm="8">
                  <div className="text-form pb-2"> صور للمنتج</div>

                  <Dropzone
                      onDrop={(acceptedFiles) => setImages(acceptedFiles)}
                  >
                      {({ getRootProps, getInputProps }) => (
                          <section>
                              <div {...getRootProps()}>
                                  <input {...getInputProps()} />
                                  <img
                                      src={avatar}
                                      alt=""
                                      height="100px"
                                      width="120px"
                                  />

                                  {/* <p>Drag 'n' drop some files here, or click to select files</p> */}
                              </div>
                          </section>
                      )}
                  </Dropzone>

                  <input
                      type="text"
                      className="input-form d-block mt-3 px-3"
                      placeholder="اسم المنتج"
                      value={prodName}
                      onChange={onChangeProdName}
                  />
                  <textarea
                      className="input-form-area p-2 mt-3"
                      rows="4"
                      cols="50"
                      placeholder="وصف المنتج"
                      value={prodDescription}
                      onChange={onChangeDescName}
                  />
                  <input
                      type="number"
                      className="input-form d-block mt-3 px-3"
                      placeholder="السعر قبل الخصم"
                      value={priceBefore}
                      onChange={onChangePriceBefore}
                  />
                  <input
                      type="number"
                      className="input-form d-block mt-3 px-3"
                      placeholder="السعر بعد الخصم"
                      value={priceAfter}
                      onChange={onChangePriceAfter}
                  />
                  <input
                      type="number"
                      className="input-form d-block mt-3 px-3"
                      placeholder="الكمية المتاحة"
                      value={qty}
                      onChange={onChangeQty}
                  />
                  <select
                      name="product_category_id"
                      value={catID}
                      // eslint-disable-next-line no-undef
                      onChange={onSelectCategory}
                      id="lang"
                      className="select input-form-area mt-3 px-2 "
                  >
                      <option value="0">التصنيف الرئيسي</option>
                      {categories.data
                          ? categories.data.map((item, index) => {
                                return (
                                    <option value={item.id} key={index}>
                                        {item.name}
                                    </option>
                                );
                            })
                          : null}
                  </select>

                  <Multiselect
                      className="mt-2 text-end"
                      placeholder="التصنيف الفرعي"
                      options={options}
                      onSelect={onSelect}
                      onRemove={onRemove}
                      displayValue="name"
                      style={{ color: "red" }}
                  />

                  <select
                      name="brand"
                      onChange={onSelectBrand}
                      id="brand"
                      className="select input-form-area mt-3 px-2 "
                  >
                      <option value="0">اختر ماركة</option>
                      {brands.data
                          ? brands.data.map((item, index) => {
                                return (
                                    <option value={item.id} key={index}>
                                        {item.name}
                                    </option>
                                );
                            })
                          : null}
                  </select>
                  <div className="text-form mt-3 "> الالوان المتاحه للمنتج</div>
                  <div className="mt-1 d-flex">
                      {colors.length
                          ? colors.map((color, index) => {
                                return (
                                    <div
                                        key={index}
                                        onClick={()=>removeColor(color)}
                                        className="color ms-2 border  mt-1"
                                        style={{ backgroundColor: color }}
                                    ></div>
                                );
                            })
                          : null}

                      <img
                          onClick={onChangeColor}
                          src={add}
                          alt=""
                          width="30px"
                          height="35px"
                          style={{ cursor: "pointer" }}
                      />
                      {showColor === true ? (
                          <CompactPicker
                              onChangeComplete={handleChangeComplete}
                          />
                      ) : null}
                  </div>
              </Col>
          </Row>
          <Row>
              <Col sm="8" className="d-flex justify-content-end ">
                  <button onClick={handelSubmit} className="btn-save d-inline mt-2 ">
                      حفظ التعديلات
                  </button>
              </Col>
          </Row>
          <ToastContainer />
      </div>
  );
}

export default AdminEditProduct