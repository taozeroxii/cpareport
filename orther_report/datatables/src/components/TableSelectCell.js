import React from 'react';
import PropTypes from 'prop-types';
import clsx from 'clsx';
import Checkbox from '@material-ui/core/Checkbox';
import TableCell from '@material-ui/core/TableCell';
import { withStyles } from '@material-ui/core/styles';
import ExpandButton from './ExpandButton';

const defaultSelectCellStyles = theme => ({
  root: {
    '@media print': {
      display: 'none',
    },
  },
  fixedHeader: {
    position: 'sticky',
    top: '0px',
    zIndex: 100,
  },
  fixedLeft: {
    position: 'sticky',
    left: '0px',
    zIndex: 100,
  },
  icon: {
    cursor: 'pointer',
    transition: 'transform 0.25s',
  },
  expanded: {
    transform: 'rotate(90deg)',
  },
  hide: {
    visibility: 'hidden',
  },
  headerCell: {
    zIndex: 110,
    backgroundColor: theme.palette.background.paper,
  },
  expandDisabled: {},
  checkboxRoot: {},
  checked: {},
  disabled: {},
});

class TableSelectCell extends React.Component {
  static propTypes = {
    /** Select cell checked on/off */
    checked: PropTypes.bool.isRequired,
    /** Select cell part of fixed header */
    fixedHeader: PropTypes.bool,
    /** Callback to trigger cell update */
    onChange: PropTypes.func,
    /** Extend the style applied to components */
    classes: PropTypes.object,
    /** Is expandable option enabled */
    expandableOn: PropTypes.bool,
    /** Adds extra class, `expandDisabled` when the row is not expandable. */
    hideExpandButton: PropTypes.bool,
    /** Is selectable option enabled */
    selectableOn: PropTypes.string,
    /** Select cell disabled on/off */
  };

  static defaultProps = {
    isHeaderCell: false,
    isRowExpanded: false,
    expandableOn: false,
    selectableOn: 'none',
  };

  render() {
    const {
      classes,
      fixedHeader,
      fixedSelectColumn,
      isHeaderCell,
      expandableOn,
      selectableOn,
      isRowExpanded,
      onExpand,
      isRowSelectable,
      selectableRowsHeader,
      hideExpandButton,
      expandableRowsHeader,
      expandedRows,
      areAllRowsExpanded = () => false,
      selectableRowsHideCheckboxes,
      setHeadCellRef,
      dataIndex,
      components = {},
      ...otherProps
    } = this.props;
    let fixedHeaderClasses;

    if (!expandableOn && selectableOn === 'none') return false;

    const CheckboxComponent = components.Checkbox || Checkbox;
    const ExpandButtonComponent = components.ExpandButton || ExpandButton;

    const cellClass = clsx({
      [classes.root]: true,
      [classes.fixedHeader]: fixedHeader && isHeaderCell,
      [classes.fixedLeft]: fixedSelectColumn,
      [classes.headerCell]: isHeaderCell,
    });

    const buttonClass = clsx({
      [classes.expandDisabled]: hideExpandButton,
    });

    const iconClass = clsx({
      [classes.icon]: true,
      [classes.hide]: isHeaderCell && !expandableRowsHeader,
      [classes.expanded]: isRowExpanded || (isHeaderCell && areAllRowsExpanded()),
    });
    const iconIndeterminateClass = clsx({
      [classes.icon]: true,
      [classes.hide]: isHeaderCell && !expandableRowsHeader,
    });

    let refProp = {};
    if (setHeadCellRef) {
      refProp.ref = el => {
        setHeadCellRef(0, 0, el);
      };
    }

    const renderCheckBox = () => {
      if (isHeaderCell && (selectableOn !== 'multiple' || selectableRowsHeader === false)) {
        // only display the header checkbox for multiple selection.
        return null;
      }
      return (
        <CheckboxComponent
          classes={{
            root: classes.checkboxRoot,
            checked: classes.checked,
            disabled: classes.disabled,
          }}
          data-description={isHeaderCell ? 'row-select-header' : 'row-select'}
          data-index={dataIndex || null}
          color="primary"
          disabled={!isRowSelectable}
          {...otherProps}
        />
      );
    };

    return (
      <TableCell className={cellClass} padding="checkbox" {...refProp}>
        <div style={{ display: 'flex', alignItems: 'center' }}>
          {expandableOn && (
            <ExpandButtonComponent
              isHeaderCell={isHeaderCell}
              areAllRowsExpanded={areAllRowsExpanded}
              expandedRows={expandedRows}
              onExpand={onExpand}
              expandableRowsHeader={expandableRowsHeader}
              buttonClass={buttonClass}
              iconIndeterminateClass={iconIndeterminateClass}
              iconClass={iconClass}
              dataIndex={dataIndex}
            />
          )}
          {selectableOn !== 'none' && selectableRowsHideCheckboxes !== true && renderCheckBox()}
        </div>
      </TableCell>
    );
  }
}

export default withStyles(defaultSelectCellStyles, { name: 'MUIDataTableSelectCell' })(TableSelectCell);
