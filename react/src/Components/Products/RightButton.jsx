import prev from '../../Assets/images/prev.png'

const RightButton = (onClick, onDisable) => {
  return (
    <img
        src={prev}
        alt=''
        width='35px'
        onClick={onClick}
        // eslint-disable-next-line react/no-unknown-property
        onDisable={onDisable}
        height='35px'
        style={{ float: 'right', marginTop: '220px', cursor: 'pointer' }}
    />
  )
}

export default RightButton